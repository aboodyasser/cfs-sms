<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'name' => 'Administration Department',
                'code' => 'ADMIN',
                'description' => 'Responsible for general administration and organizational management.',
                'status' => 'active',
            ],
            [
                'name' => 'Finance Department',
                'code' => 'FIN',
                'description' => 'Responsible for financial management, budgeting, expenses, and financial reporting.',
                'status' => 'active',
            ],
            [
                'name' => 'Human Resources Department',
                'code' => 'HR',
                'description' => 'Responsible for human resources, staff management, and employee records.',
                'status' => 'active',
            ],
            [
                'name' => 'Programs Department',
                'code' => 'PROGRAMS',
                'description' => 'Responsible for program planning, implementation, monitoring, and coordination.',
                'status' => 'active',
            ],
            [
                'name' => 'Projects Department',
                'code' => 'PROJECTS',
                'description' => 'Responsible for project planning, implementation, and project management.',
                'status' => 'active',
            ],
            [
                'name' => 'IT Department',
                'code' => 'IT',
                'description' => 'Responsible for information technology, systems, infrastructure, and technical support.',
                'status' => 'active',
            ],
            [
                'name' => 'Procurement Department',
                'code' => 'PROC',
                'description' => 'Responsible for procurement processes, suppliers, purchasing, and contracts.',
                'status' => 'active',
            ],
            [
                'name' => 'Monitoring & Evaluation Department',
                'code' => 'M&E',
                'description' => 'Responsible for monitoring, evaluation, indicators, and performance reporting.',
                'status' => 'active',
            ],
        ];

        foreach ($departments as $department) {
            Department::updateOrCreate(
                ['code' => $department['code']],
                $department
            );
        }

        $positions = [
            [
                'name' => 'Executive Director',
                'code' => 'EXEC-DIR',
                'description' => 'Provides overall organizational leadership and strategic direction.',
                'status' => 'active',
            ],
            [
                'name' => 'Administrator',
                'code' => 'ADMIN',
                'description' => 'Manages administrative operations and organizational support.',
                'status' => 'active',
            ],
            [
                'name' => 'Finance Manager',
                'code' => 'FIN-MGR',
                'description' => 'Manages financial operations, controls, approvals, and reporting.',
                'status' => 'active',
            ],
            [
                'name' => 'Finance Officer',
                'code' => 'FIN-OFF',
                'description' => 'Handles financial transactions, records, and supporting documentation.',
                'status' => 'active',
            ],
            [
                'name' => 'HR Officer',
                'code' => 'HR-OFF',
                'description' => 'Handles human resources and staff-related processes.',
                'status' => 'active',
            ],
            [
                'name' => 'Project Manager',
                'code' => 'PM',
                'description' => 'Plans, coordinates, and manages project implementation.',
                'status' => 'active',
            ],
            [
                'name' => 'Program Officer',
                'code' => 'PROG-OFF',
                'description' => 'Supports program planning, implementation, and reporting.',
                'status' => 'active',
            ],
            [
                'name' => 'Procurement Officer',
                'code' => 'PROC-OFF',
                'description' => 'Handles procurement activities, quotations, suppliers, and purchasing documentation.',
                'status' => 'active',
            ],
            [
                'name' => 'Monitoring & Evaluation Officer',
                'code' => 'ME-OFF',
                'description' => 'Handles monitoring, indicators, data collection, and evaluation activities.',
                'status' => 'active',
            ],
            [
                'name' => 'Document Officer',
                'code' => 'DOC-OFF',
                'description' => 'Manages organizational documents, records, and document workflows.',
                'status' => 'active',
            ],
            [
                'name' => 'IT Officer',
                'code' => 'IT-OFF',
                'description' => 'Handles systems, technical support, and IT infrastructure.',
                'status' => 'active',
            ],
            [
                'name' => 'Auditor / Reviewer',
                'code' => 'AUD-REV',
                'description' => 'Reviews records, transactions, compliance, and audit-related activities.',
                'status' => 'active',
            ],
        ];

        foreach ($positions as $position) {
            Position::updateOrCreate(
                ['code' => $position['code']],
                $position
            );
        }
    }
}
