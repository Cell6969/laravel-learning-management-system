<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property int $course_id
 * @property string $section_title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseLecture> $course_lecture
 * @property-read int|null $course_lecture_count
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereSectionTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseSection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CourseSection extends Model
{
    use HasFactory;

    protected $table = 'course_sections';

    protected $primaryKey = 'id';

    protected $keyType = 'integer';

    protected $guarded = [];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function course_lecture(): HasMany
    {
        return $this->hasMany(CourseLecture::class, 'section_id', 'id');
    }
}
