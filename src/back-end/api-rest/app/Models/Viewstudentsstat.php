<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Viewstudentsstat
 * 
 * @property int $asistanceClass
 * @property int $idUser
 * @property string $userName
 * @property string $userSurname
 * @property string $mail
 * @property string $indentificationNumber
 * @property string $dni
 * @property string $subjectName
 * @property int $idSubject
 * @property int $idCourse
 * @property string $courseName
 * @property float|null $numberBaned
 *
 * @package App\Models
 */
class Viewstudentsstat extends Model
{
	protected $table = 'viewstudentsstats';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'asistanceClass' => 'int',
		'idUser' => 'int',
		'idSubject' => 'int',
		'idCourse' => 'int',
		'numberBaned' => 'float'
	];

	protected $fillable = [
		'asistanceClass',
		'idUser',
		'userName',
		'userSurname',
		'mail',
		'indentificationNumber',
		'dni',
		'subjectName',
		'idSubject',
		'idCourse',
		'courseName',
		'numberBaned'
	];
}
