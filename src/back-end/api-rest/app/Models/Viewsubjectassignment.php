<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Viewsubjectassignment
 * 
 * @property int $idSubjectCourse
 * @property int $idSubject
 * @property string $subjectName
 * @property int $idCourse
 * @property string $courseName
 *
 * @package App\Models
 */
class Viewsubjectassignment extends Model
{
	protected $table = 'viewsubjectassignment';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idSubjectCourse' => 'int',
		'idSubject' => 'int',
		'idCourse' => 'int'
	];

	protected $fillable = [
		'idSubjectCourse',
		'idSubject',
		'subjectName',
		'idCourse',
		'courseName'
	];
}
