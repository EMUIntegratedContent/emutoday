<?php

namespace Emutoday\Http\Controllers\Admin\Event;

use Emutoday\Helpers\Interfaces\IBug;
use Emutoday\MiniCalendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MiniCalendarController extends \Emutoday\Http\Controllers\Admin\Controller
{
    protected $mini;
    protected $bugService;

    public function __construct(MiniCalendar $mini, IBug $bugService)
    {
        parent::__construct();
        $this->mini = $mini;
        $this->bugService = $bugService;

        
        View::share('bugAnnouncements', $this->bugService->getUnapprovedAnnouncements());
        View::share('bugEvents', $this->bugService->getUnapprovedEvents());
        View::share('bugStories', $this->bugService->getUnapprovedStories());
        View::share('bugExperts', $this->bugService->getUnapprovedExperts());
        View::share('bugExpertMediaRequests', $this->bugService->getNewExpertMediaRequests());
        View::share('bugInsideemuIdeas', $this->bugService->getNewInsideemuIdeas());
    }

    public function index()
    {
        $minicals = $this->mini->orderBy('calendar')->get();

        return view('admin.event.minicals.index', compact('minicals'));
    }

    public function create()
    {
        $parents = $this->mini->orderBy('calendar')->get();

        return view('admin.event.minicals.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'calendar' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|regex:/^[a-z0-9-]+$/|unique:cea_mini_calendars,slug',
            'parent' => 'nullable|exists:cea_mini_calendars,id',
        ], [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers, and hyphens.',
        ]);

        $slugSource = empty($data['slug']) ? $data['calendar'] : $data['slug'];
        $data['slug'] = $this->generateUniqueSlug($slugSource);

        $this->mini->create($data);

        return redirect('/admin/event/minicals')->with('success', 'Mini Calendar created.');
    }

    public function edit($id)
    {
        $minical = $this->mini->findOrFail($id);
        $parents = $this->mini->where('id', '<>', $id)->orderBy('calendar')->get();

        return view('admin.event.minicals.edit', compact('minical', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $minical = $this->mini->findOrFail($id);

        $data = $request->validate([
            'calendar' => 'required|string|max:255',
            'slug' => ['nullable','string','max:255','regex:/^[a-z0-9-]+$/', Rule::unique('cea_mini_calendars','slug')->ignore($id,'id')],
            'parent' => 'nullable|exists:cea_mini_calendars,id',
        ], [
            'slug.regex' => 'The slug may only contain lowercase letters, numbers, and hyphens.',
        ]);

        if (isset($data['parent']) && $data['parent'] == $id) {
            return back()->withErrors(['parent' => 'A mini calendar cannot be its own parent.'])->withInput();
        }

        $slugSource = empty($data['slug']) ? $data['calendar'] : $data['slug'];
        $data['slug'] = $this->generateUniqueSlug($slugSource, $id);

        $minical->update($data);

        return redirect('/admin/event/minicals')->with('success', 'Mini Calendar updated.');
    }

    /**
     * Create a kebab-case slug and append numeric suffix if necessary to ensure uniqueness.
     */
    protected function generateUniqueSlug($value, $ignoreId = null)
    {
        $slug = Str::slug($value);
        $base = $slug;
        $i = 2;

        while ($this->slugExists($slug, $ignoreId)) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    protected function slugExists($slug, $ignoreId = null)
    {
        $query = $this->mini->where('slug', $slug);
        if ($ignoreId) {
            $query->where('id', '<>', $ignoreId);
        }
        return $query->exists();
    }

}
