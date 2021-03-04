<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Degree
 * 
 * @property int $idDegree
 * @property string $degreeName
 * @property int|null $active
 * 
 * @property Collection|Subject[] $subjects
 *
 * @package App\Models
 */
class Degree extends Model
{
	protected $table = 'degree';
	protected $primaryKey = 'idDegree';
	public $timestamps = false;

	protected $casts = [
		'active' => 'int'
	];

	protected $fillable = [
		'degreeName',
		'active'
	];

	public function subjects()
	{
		return $this->belongsToMany(Subject::class, 'subject_in_degree', 'idDegree', 'idSubject')
					->withPivot('idSubjectDegree', 'active');
	}
}
