<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectInDegree
 * 
 * @property int $idSubjectDegree
 * @property int $idDegree
 * @property int $idSubject
 * @property int|null $active
 * 
 * @property Degree $degree
 * @property Subject $subject
 *
 * @package App\Models
 */
class SubjectInDegree extends Model
{
	protected $table = 'subject_in_degree';
	protected $primaryKey = 'idSubjectDegree';
	public $timestamps = false;

	protected $casts = [
		'idDegree' => 'int',
		'idSubject' => 'int',
		'active' => 'int'
	];

	protected $fillable = [
		'idDegree',
		'idSubject',
		'active'
	];

	public function degree()
	{
		return $this->belongsTo(Degree::class, 'idDegree');
	}

	public function subject()
	{
		return $this->belongsTo(Subject::class, 'idSubject');
	}
}
