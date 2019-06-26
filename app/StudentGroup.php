<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentGroup extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_group';
}