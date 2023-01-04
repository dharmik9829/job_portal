<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listings extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'tags', 'company', 'location', 'website', 'email', 'description', 'logo', 'user_id'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', "%" . request('tag') . "%");
        }

        if ($filters['search'] ?? false) {
            $query->where('title', 'like', "%" . request('search') . "%")
                ->orWhere('tags', 'like', "%" . request('search') . "%")
                ->orWhere('description', 'like', "%" . request('search') . "%");
        }
    }

    public function store(Request $request)
    {
        $formFileds = $request->validate(
            [
                'title' => "required",
                'company' => ['required', Rule::unique('listings', 'company')],
                'location' => 'required',
                'website' => "required",
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required'
            ]
        );

        Listings::create($formFileds);
        return redirect('/')->with('message', "Listing Created Sucessfully");
    }

    // Relationship to user 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
