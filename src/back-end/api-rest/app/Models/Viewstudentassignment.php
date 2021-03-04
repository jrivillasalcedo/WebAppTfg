<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Viewstudentassignment
 * 
 * @property int $idStudentRegistered
 * @property string $indentificationNumber
 * @property string $userName
 * @property string $userSurname
 * @property string $dni
 * @property int $idUser
 * @property int $idSubject
 * @property string $subjectName
 * @property int $idCourse
 * @property string $courseName
 *
 * @package App\Models
 */
class Viewstudentassignment extends Model
{
	protected $table = 'viewstudentassignment';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idStudentRegistered' => 'int',
		'idUser' => 'int',
		'idSubject' => 'int',
		'idCourse' => 'int'
	];

	protected $fillable = [
		'idStudentRegistered',
		'indentificationNumber',
		'userName',
		'userSurname',
		'dni',
		'idUser',
		'idSubject',
		'subjectName',
		'idCourse',
		'courseName'
	];
}
