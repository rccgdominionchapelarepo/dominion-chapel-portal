<?php

namespace App\Exports;

use App\Models\ChurchMember;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MembershipExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // By querying members (not families), every individual gets their own row in Excel
        return ChurchMember::with('family')->get();
    }

    public function headings(): array
    {
        return [
            'Family Name', 'Full Name', 'Preferred Name', 'Date of Birth', 
            'Gender', 'Marital Status', 'Church Group', 'Membership Status', 
            'Water Baptism', 'Areas to Serve', 'Family Email', 'Family Phone', 'Home Address'
        ];
    }

    public function map($member): array
    {
        // Clean the family name (removes the word 'Family' if they typed it, then forces it at the end)
        $cleanName = trim(preg_replace('/\bfamily\b/i', '', $member->family->family_name));
        $finalFamilyName = $cleanName . ' Family';

        // Convert the JSON array of checkboxes back into a readable comma-separated string
        $areasToServe = is_array($member->areas_to_serve) ? implode(', ', $member->areas_to_serve) : '';

        return [
            $finalFamilyName,
            $member->full_name,
            $member->preferred_name,
            $member->dob ? $member->dob->format('d/M/Y') : 'N/A',
            $member->gender,
            $member->marital_status,
            $member->church_group,
            $member->membership_status,
            $member->water_baptism,
            $areasToServe,
            $member->family->email,
            $member->family->phone_number,
            $member->family->home_address,
        ];
    }
}