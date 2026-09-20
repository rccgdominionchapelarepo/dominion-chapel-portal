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
        return ChurchMember::with('family')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Family Name', 
            'Full Name', 
            'Preferred Name', 
            'Personal Email', 
            'Personal Phone', 
            'Date of Birth', 
            'Gender', 
            'Marital Status', 
            'Church Group', 
            'Membership Status', 
            'Water Baptism', 
            'Areas to Serve', 
            'Family Email', 
            'Family Phone', 
            'Home Address'
        ];
    }

    public function map($member): array
    {
        // Clean the family name
        $cleanName = trim(preg_replace('/\bfamily\b/i', '', $member->family->family_name));
        $finalFamilyName = $cleanName . ' Family';

        // Clean any old array data formatting from areas_to_serve
        $areasToServe = $member->areas_to_serve ? trim(str_replace(['[', ']', '"'], '', $member->areas_to_serve)) : 'N/A';

        return [
            $finalFamilyName,
            $member->full_name,
            $member->preferred_name,
            $member->email ?: 'N/A',
            $member->phone_number ?: 'N/A',
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