<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository extends BaseRepository
{
    /**
     * Create a new ContactRepository instance.
     *
     * @param  \App\Models\Contact $contact
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
    }

    /**
     * Get contacts collection.
     *
     * @return Illuminate\Support\Collection
     */
    public function getContactsOrder()
    {
        return $this->model->oldest('seen')->latest()->get();
    }

    /**
     * Store a contact.
     *
     * @param  array $inputs
     * @return void
     */
    public function store($inputs)
    {
        $this->model->create($inputs);
    }

    /**
     * Update a contact.
     *
     * @param  bool  $seen
     * @param  int   $id
     * @return void
     */
    public function update($seen, $id)
    {
        $contact = $this->getById($id);

        $contact->seen = $seen == 'true';

        $contact->save();
    }
}
