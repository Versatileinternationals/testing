<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlzLoanSection extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'image','Status'];
    protected $table = "BlzInvest_Loan_Section";

    
}
