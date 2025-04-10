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
}


