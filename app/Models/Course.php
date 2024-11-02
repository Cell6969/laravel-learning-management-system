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
 * @property int $category_id
 * @property int $subcategory_id
 * @property int $instructor_id
 * @property string|null $course_image
 * @property string|null $course_title
 * @property string|null $course_name
 * @property string|null $course_name_slug
 * @property string|null $description
 * @property string|null $video
 * @property string|null $label
 * @property string|null $duration
 * @property string|null $resources
 * @property string|null $certificate
 * @property int|null $selling_price
 * @property int|null $discount_price
 * @property string|null $prerequisites
 * @property string|null $bestseller
 * @property string|null $featured
 * @property string|null $highestrated
 * @property int $status 0=Inactive, 1=Active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CourseGoal> $course_goal
 * @property-read int|null $course_goal_count
 * @property-read \App\Models\User $instructor
 * @property-read \App\Models\SubCategory $subcategory
 * @method static \Illuminate\Database\Eloquent\Builder|Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereBestseller($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCourseImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCourseName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCourseNameSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCourseTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDiscountPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereHighestrated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereInstructorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course wherePrerequisites($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereResources($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSellingPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereSubcategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Course whereVideo($value)
 * @mixin \Eloquent
 */
class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected $guarded = [];
    public $timestamps = true;
    public $incrementing = true;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id', 'id');
    }

    public function course_goal(): HasMany
    {
        return $this->hasMany(CourseGoal::class, 'course_id', 'id');
    }
}
