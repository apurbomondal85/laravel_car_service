<?php

namespace App\Observers;

use App\Models\Blog;
use App\Library\Helper;

class BlogObserver
{
    /**
     * Handle the Blog "created" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog)
    {
        $difference = Helper::getDifference($blog, false, true);

        Helper::createActivityLog('Created', 'Blog', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Blog "updated" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function updated(Blog $blog)
    {
        $difference = Helper::getDifference($blog, true);

        Helper::createActivityLog('Updated', 'Blog', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function deleted(Blog $blog)
    {
        $difference = Helper::getDifference($blog);

        Helper::createActivityLog('Deleted', 'Blog', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Blog "restored" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function restored(Blog $blog)
    {
        $difference = Helper::getDifference($blog);

        Helper::createActivityLog('Restored', 'Blog', $difference, request()->ip(), request()->userAgent());
    }

    /**
     * Handle the Blog "force deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function forceDeleted(Blog $blog)
    {
        $difference = Helper::getDifference($blog);

        Helper::createActivityLog('Force Deleted', 'Blog', $difference, request()->ip(), request()->userAgent());
    }
}
