<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $idCourse
 * @property string $courseName
 * @property int $actualCourse
 * @property int|null $active
 * 
 * @property Collection|Subject[] $subjects
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'course';
	protected $primaryKey = 'idCourse';
	public $timestamps = false;

	protected $casts = [
		'actualCourse' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'courseName',
		'actualCourse',
		'active'
	];

	public function subjects()
	{
		return $this->belongsToMany(Subject::class, 'subject_course', 'idCourse', 'idSubject')
					->withPivot('idSubjectCourse', 'obs');
	}
}
