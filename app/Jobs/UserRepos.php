<?php

namespace App\Jobs;

use App\Models\Commit;
use App\Models\Project;
use App\Models\PullRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Ssionn\GithubForgeLaravel\Facades\GithubForge;

class UserRepos implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $username, protected $userId)
    {
        $this->username = $username;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $allRepos = GithubForge::getRepositories($this->username);

        foreach ($allRepos as $repository) {
            $project = Project::updateOrCreate(
                [
                    'name' => $repository['name'],
                    'full_name' => $repository['full_name'],
                    'owner' => $repository['owner']['login'],
                ],
                [
                    'description' => $repository['description'] ?? 'description not provided',
                    'url' => $repository['url'],
                    'html_url' => $repository['html_url'],
                    'user_id' => $this->userId,
                ]
            );

            $project->created_at = Carbon::parse($repository['created_at']);
            $project->updated_at = Carbon::parse($repository['updated_at']);
            $project->save();

            $pullRequests = GithubForge::getPullRequests($repository['owner']['login'], $repository['name']);
            foreach ($pullRequests as $pullRequest) {
                $pullRequestModel = PullRequest::updateOrCreate(
                    [
                        'html_url' => $pullRequest['html_url'],
                    ],
                    [
                        'title' => $pullRequest['title'],
                        'body' => $pullRequest['body'],
                        'state' => $pullRequest['state'],
                        'project_id' => $project->id,
                    ]
                );

                $pullRequestModel->created_at = Carbon::parse($pullRequest['created_at']);
                $pullRequestModel->updated_at = Carbon::parse($pullRequest['updated_at']);
                $pullRequestModel->save();
            }

            $commits = GithubForge::getCommitsFromRepository($repository['owner']['login'], $repository['name']);
            foreach ($commits as $commit) {
                $commitModel = Commit::updateOrCreate(
                    [
                        'sha' => $commit['sha'],
                    ],
                    [
                        'project_id' => $project->id,
                    ]
                );

                $commitModel->created_at = Carbon::parse($commit['commit']['author']['date']);
                $commitModel->updated_at = Carbon::parse($commit['commit']['author']['date']);
                $commitModel->save();
            }
        }
    }
}
