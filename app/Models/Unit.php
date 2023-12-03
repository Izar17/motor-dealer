<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = 
    [
        'id',
        'branch_id',
        'unit_model_id',
        'customer_application_id',
        'engine_number',
        'frame_number',
        'chassis_number',
        'status',
        'notes',
    ];

    public function assignToCustomerApplication(int $customerApplicationId): void
    {
        $this->attributes['customer_application_id'] = $customerApplicationId;
        $this->save();
    }

    public function getStock():int {
        $count = Unit::where('model_name', 'ducati')->count();
        return $count;
    }

    public function unitModel():BelongsTo{
        return $this->belongsTo(UnitModel::class);
    }

    public function branch():BelongsTo{
        return $this->belongsTo(Branch::class);
    }

    public function customerApplication(): HasMany{
        return $this->hasMany(CustomerApplication::class);
    }

    public function incomingUnit(): HasMany{
        return $this->hasMany(IncomingUnit::class);
    }

    public function outgoingUnit(): HasMany{
        return $this->hasMany(OutgoingUnit::class);
    }

}
