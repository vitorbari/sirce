<?php namespace Sirce\Models\Observers;


use Illuminate\Support\Facades\Cache;

class ComponentObserver
{

    /**
     * Model related cache keys
     *
     * @var array
     */
    protected $keys = [
        'component_newest'
    ];

    protected function clearCache()
    {
        foreach($this->keys as $key) {
            Cache::forget($key);
        }
    }

    public function saved()
    {
        $this->clearCache();
    }

    public function deleted()
    {
        $this->clearCache();
    }

    public function restored()
    {
        $this->clearCache();
    }

}