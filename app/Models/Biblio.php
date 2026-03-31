<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Biblio extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'biblios';
    protected $primaryKey = 'biblio_id';

    protected $fillable = [
        'title',
        'publisher_id',
        'gmd_id',
        'isbn_issn',
        'publish_year',
        'classification',
        'cover_image',
    ];

    public function publisher()
    {
        return $this->belongsTo(MstPublisher::class, 'publisher_id', 'publisher_id');
    }

    public function gmd()
    {
        return $this->belongsTo(MstGmd::class, 'gmd_id', 'gmd_id');
    }

    public function authors()
    {
        return $this->belongsToMany(MstAuthor::class, 'biblio_authors', 'biblio_id', 'author_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(MstSubject::class, 'biblio_subjects', 'biblio_id', 'subject_id');
    }

    public function topics()
    {
        return $this->belongsToMany(MstTopic::class, 'biblio_topics', 'biblio_id', 'topic_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'biblio_id', 'biblio_id');
    }
}
