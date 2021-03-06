<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patient;
use App\Medications;
use App\Treatment;
use App\Tracing;

class Meeting extends Model {
    
    protected $table = "meetings";

    public function scopeSearch ( $query, $id_number, $meeting_status ) {
        $query = $query->with( 'patient' )->whereHas('patient', function ( $queryPatient ) use ($id_number) {
            $queryPatient->where( 'id_number', 'LIKE', '%' . $id_number . '%' );
        })->where('meeting_status', 'LIKE', $meeting_status);

        return $query;
    }

    public function patient () {
    	return $this->belongsTo('App\Patient', 'patient_id');
    }

    public function treatment () {
        return $this->belongsTo('App\Treatment', 'treatment_id');
    }

    public function tracing () {
        return $this->belongsTo('App\Tracing', 'tracing_id');
    }

    public function medications () {
        return $this->hasMany('App\Medication', 'meeting_id');
    }

    public function meetingType() {
    	
    	if ( $this->treatment_id != null ) {
    		return 'Tratamiento';
    	} else if ( $this->tracing_id != null ) {
    		return 'Seguimiento';
    	}

    	return 'SIN ASIGNAR';

    }

}
