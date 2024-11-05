<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int|null $course_id
 * @property int $section_id
 * @property string|null $lecture_title
 * @property string|null $video
 * @property string|null $url
 * @property string|null $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\CourseSection $course_section
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereLectureTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseLecture whereVideo($value)
 * @mixin \Eloquent
 */
class CourseLecture extends Model
{
    use HasFactory;

    protected $table = "course_lectures";

    protected $primaryKey = "id";

    protected $keyType = "integer";

    protected $guarded = [];

    public $incrementing = true;

    public $timestamps = true;

    public function course_section(): BelongsTo
    {
        return $this->belongsTo(CourseSection::class, 'section_id', 'id');
    }
}
