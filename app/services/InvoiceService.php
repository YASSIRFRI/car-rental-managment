<?php

namespace App\Services;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Rental;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;

class InvoiceService
{
    public function createInvoice($rentals, Client $client, User $agency)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        // Add title
        $section->addTitle('Invoice', 1);

        // Client information
        $section->addText('Client Information:', ['bold' => true]);
        $section->addText("Name: {$client->name}");
        $section->addText("Phone: {$client->phone}");
        $section->addText("Email: {$client->email}");

        // Agency information
        $section->addText('Agency Information:', ['bold' => true]);
        $section->addText("Name: {$agency->name}");
        $section->addText("Email: {$agency->email}");
        $section->addText("Address: {$agency->address}, {$agency->city}, {$agency->zip_code}");

        // General information
        $section->addText("Date: " . Carbon::now()->format('Y-m-d'));

        // Rental details
        $section->addText('Rental Details:', ['bold' => true]);
        $table = $section->addTable();

        // Add header row
        $table->addRow();
        $table->addCell(2000)->addText('Number', ['bold' => true]);
        $table->addCell(3000)->addText('Model', ['bold' => true]);
        $table->addCell(3000)->addText('Start Date', ['bold' => true]);
        $table->addCell(3000)->addText('End Date', ['bold' => true]);
        $table->addCell(2000)->addText('Amount', ['bold' => true]);

        // Add data rows
        foreach ($rentals as $index => $rental) {
            $table->addRow();
            $table->addCell(2000)->addText($index + 1);
            $table->addCell(3000)->addText($rental->vehicle->model->name);
            $table->addCell(3000)->addText($rental->start_date);
            $table->addCell(3000)->addText($rental->end_date);
            $table->addCell(2000)->addText($rental->amount);
        }

        // Total amount
        $totalAmount = $rentals->sum('amount');
        $section->addText("Total Amount: {$totalAmount}", ['bold' => true]);

        // Save file
        $filename = 'invoice-' . Carbon::now()->format('Y-m-d-H-i-s') . '.docx';
        $path = storage_path('app/invoices/' . $filename);

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($path);

        return new InvoiceResult($path, $filename);
    }
}
