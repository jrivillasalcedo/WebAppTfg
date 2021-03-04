<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Viewteacherassignment
 * 
 * @property int $idTeacherSubject
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
class Viewteacherassignment extends Model
{
	protected $table = 'viewteacherassignment';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idTeacherSubject' => 'int',
		'idUser' => 'int',
		'idSubject' => 'int',
		'idCourse' => 'int'
	];

	protected $fillable = [
		'idTeacherSubject',
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
