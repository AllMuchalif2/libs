<?php

namespace App\Livewire;

use App\Models\Member;
use App\Models\Visitor;
use Livewire\Component;

class GuestBookForm extends Component
{
    public $input = '';
    public $alertMessage = '';
    public $status = '';

    public function save()
    {
        $this->validate([
            'input' => 'required|min:3',
        ], [
            'input.required' => 'Masukkan Kode Anggota atau Nama Anda.',
            'input.min' => 'Input minimal 3 karakter.',
        ]);

        $member = Member::where('member_code', $this->input)->first();

        if ($member) {
            // Rate limit check for member (20 minutes)
            $lastVisit = Visitor::where('member_id', $member->member_id)
                ->where('visit_date', '>=', now()->subMinutes(20))
                ->first();

            if ($lastVisit) {
                $this->status = 'error';
                $this->alertMessage = "Halo {$member->name}, Anda sudah mengisi buku tamu dalam 20 menit terakhir.";
                return;
            }

            Visitor::create([
                'member_id' => $member->member_id,
                'name' => $member->name,
                'visit_date' => now(),
            ]);

            $this->status = 'success';
            $this->alertMessage = "Selamat Datang, {$member->name}! Kunjungan Anda telah dicatat.";
        } else {
            // Guest visit
            Visitor::create([
                'member_id' => null,
                'name' => $this->input,
                'visit_date' => now(),
            ]);

            $this->status = 'success';
            $this->alertMessage = "Selamat Datang, {$this->input}! Kunjunganmu telah dicatat.";
        }

        $this->input = '';
    }

    public function render()
    {
        return view('livewire.guest-book-form');
    }
}
