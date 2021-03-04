<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $idSubject
 * @property int $idCreator
 * @property string $subjectName
 * @property int|null $creditsNumber
 * @property string $semester
 * @property string $subjectType
 * @property int|null $active
 * 
 * @property User $user
 * @property Collection|Course[] $courses
 * @property Collection|Degree[] $degrees
 *
 * @package App\Models
 */
class Subject extends Model
{
	protected $table = 'subject';
	protected $primaryKey = 'idSubject';
	public $timestamps = false;

	protected $casts = [
		'idCreator' => 'int',
		'creditsNumber' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idCreator',
		'subjectName',
		'creditsNumber',
		'semester',
		'subjectType',
		'active'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idCreator');
	}

	public function courses()
	{
		return $this->belongsToMany(Course::class, 'subject_course', 'idSubject', 'idCourse')
					->withPivot('idSubjectCourse', 'obs');
	}

	public function degrees()
	{
		return $this->belongsToMany(Degree::class, 'subject_in_degree', 'idSubject', 'idDegree')
					->withPivot('idSubjectDegree', 'active');
	}
}
