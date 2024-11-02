<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $course_id
 * @property string|null $goal_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal query()
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal whereGoalName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CourseGoal whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CourseGoal extends Model
{
    use HasFactory;

    protected $table = 'course_goals';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected $guarded = [];
    public $timestamps = true;
    public $incrementing = true;
}
