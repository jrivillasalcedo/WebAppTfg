<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Viewclassrominfo
 * 
 * @property int $idClass
 * @property int $idSubjectCourse
 * @property int $idTopic
 * @property int $idTeacherCreator
 * @property int $idGroup
 * @property int $classState
 * @property string $subjectName
 * @property int $idSubject
 * @property string $groupName
 * @property string $topicName
 * @property string $userName
 * @property string $userSurname
 *
 * @package App\Models
 */
class Viewclassrominfo extends Model
{
	protected $table = 'viewclassrominfo';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idClass' => 'int',
		'idSubjectCourse' => 'int',
		'idTopic' => 'int',
		'idTeacherCreator' => 'int',
		'idGroup' => 'int',
		'classState' => 'int',
		'idSubject' => 'int'
	];

	protected $fillable = [
		'idClass',
		'idSubjectCourse',
		'idTopic',
		'idTeacherCreator',
		'idGroup',
		'classState',
		'subjectName',
		'idSubject',
		'groupName',
		'topicName',
		'userName',
		'userSurname'
	];
}
