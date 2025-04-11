<?PHP

namespace APP\Services;

use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    public function enrollUser(Course $course)
    {
        $user = Auth::user();

        // Check if user is already enrolled
        if (!$course->courseStudents()->where('user_id', $user->id)->exists()) {
            $course->courseStudents()->create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);
        }

        return $user->name;
    }

    public function getFirstSectionAndContent(Course $course): array
    {
        $firstSection = $course->courseSections()
                            ->orderBy('id')
                            ->first();

        $firstContent = $firstSection
            ? $firstSection->sectionContents()
                        ->orderBy('id')
                        ->first()
            : null;

        return [
            'firstSectionId' => $firstSection?->id,
            'firstContentId' => $firstContent?->id,
        ];
    }

    public function getLearningData(Course $course, $contentSectionId, $sectionContentId)
    {
        $course->load(['courseSections.sectionContents']);
        $currentSection = $course->courseSections->find($contentSectionId);
        $currentContent = $currentSection ? $currentSection->sectionContents->find($sectionContentId) : null;

        // EXITING TEXT, CULTURE
        $nextContent = null;

        if ($currentContent && $currentSection) {
            $nextContent = $currentSection->sectionContents
                ->where('id', '>', $currentContent->id)
                ->sortBy('id')
                ->first();
        }

        if (!$nextContent && $currentSection) {
            $nextSection = $course->courseSections
                ->where('id', '>', $currentSection->id)
                ->sortBy('id')
                ->first();

            if ($nextSection) {
                $nextContent = $nextSection->sectionContents
                    ->sortBy('id')
                    ->first();
            }
        }

        return [
            'course' => $course,
            'currentSection' => $currentSection,
            'currentContent' => $currentContent,
            'nextContent' => $nextContent,
            'jsFinished' => !$nextContent,
        ];
    }

}


