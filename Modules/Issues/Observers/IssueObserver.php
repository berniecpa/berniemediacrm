<?php

namespace Modules\Issues\Observers;

use App\Entities\Status;
use Modules\Issues\Entities\Issue;

class IssueObserver
{

    /**
     * Listen to the Issue creating event.
     *
     * @param \Modules\Issues\Entities\Issue $issue
     */
    public function creating(Issue $issue)
    {
        if (empty($issue->status_id) || is_null($issue->status_id)) {
            $issue->status_id = 1;
        }
        if (!is_numeric($issue->status_id)) {
            $status = Status::firstOrCreate(['name' => $issue->status_id], ['color' => '#fb6b5b']);
            $issue->status_id = $status->id;
        }

        if (empty($issue->assignee)) {
            $issue->assignee = $issue->project->assignees->random()->user_id;
        }

        $issue->code = generateCode('issues');
    }

    /**
     * Listen to the Issue saved event.
     *
     * @param \Modules\Issues\Entities\Issue $issue
     */
    public function saved(Issue $issue)
    {
        if (request()->has('tags')) {
            $issue->retag(collect(request('tags'))->implode(','));
        }
    }

    /**
     * Listen to the Client deleting event.
     *
     * @param \Modules\Issues\Entities\Issue $issue
     */
    public function deleting(Issue $issue)
    {
        foreach ($issue->files as $file) {
            $file->delete();
        }
        foreach ($issue->comments as $comment) {
            $comment->delete();
        }
        foreach ($issue->vault as $vault) {
            $vault->delete();
        }
        $issue->detag();
    }
}
