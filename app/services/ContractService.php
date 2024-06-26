<?php

namespace App\Services;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\User;
use Carbon\Carbon;

class ContractService
{
    public function generate(Client $client, Vehicle $vehicle, User $agency)
    {
        $phpWord = new PhpWord();

        // Adding an empty Section to the document...
        $section = $phpWord->addSection();

        // Add contract title
        $section->addText(
            'Contrat de location de voiture',
            ['name' => 'Arial', 'size' => 16, 'bold' => true]
        );

        $section->addTextBreak(2);

        $section->addText('ENTRE LES SOUSSIGNES,', ['name' => 'Arial', 'size' => 12]);
        $section->addText("Appelé ci-après le loueur,", ['name' => 'Arial', 'size' => 12]);
        $section->addText("ET", ['name' => 'Arial', 'size' => 12]);
        $section->addText("Appelé ci-après le locataire,", ['name' => 'Arial', 'size' => 12]);
        $section->addText("IL A ETE CONVENU CE QUI SUIT;", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(1);

        // Add client information
        $section->addText("Client Information:", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Nom: " . $client->name, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Téléphone: " . $client->phone, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Email: " . $client->email, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Adresse: " . $client->address, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Ville: " . $client->city, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Code postal: " . $client->zip_code, ['name' => 'Arial', 'size' => 12]);

        if ($client->type == 'personne physique') {
            $section->addText("CIN: " . $client->cin, ['name' => 'Arial', 'size' => 12]);
        } else {
            $section->addText("ICE: " . $client->ice, ['name' => 'Arial', 'size' => 12]);
        }

        $section->addTextBreak(1);

        // Add agency information
        $section->addText("Agency Information:", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Nom: " . $agency->name, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Email: " . $agency->email, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Adresse: " . $agency->address, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Ville: " . $agency->city, ['name' => 'Arial', 'size' => 12]);
        $section->addText("Code postal: " . $agency->zip_code, ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(1);

        // Add rental details
        $section->addText("1.1 - Nature et date d'effet du contrat", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Le loueur met à disposition du locataire, un véhicule de marque {$vehicle->model->name}, immatriculé {$vehicle->plate}, à titre onéreux et à compter du " . Carbon::now()->format('d/m/Y') . ". Kilométrage du véhicule : {$vehicle->mechanicalState->mileage} kms.", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(1);

        $section->addText("1.2 - Etat du véhicule", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Lors de la remise du véhicule et lors de sa restitution, un procès-verbal de l'état du véhicule sera établi entre le locataire et le loueur. Le véhicule devra être restitué le même état que lors de sa remise. Toutes les détériorations sur le véhicule constatées sur le PV de sortie seront à la charge du locataire. Le locataire certifie être en possession du permis l'autorisant à conduire le présent véhicule.", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(1);

        $section->addText("1.3 - Prix de la location du de la voiture", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Les parties s'entendent sur un prix de location {$vehicle->price} euros par jour (calendaires). Ce prix comprend un forfait pour la durée du contrat.", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(1);

        $section->addText("1.5 - Durée et restitution de la voiture", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Le contrat est à durée indéterminée. Il pourra y être mis fin par chacune des parties à tout moment en adressant un courrier recommandé en respectant un préavis d'un mois.", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(1);

        $section->addText("1.6 - Autres éléments et accessoires", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Le locataire prendra en charge l'ensemble des charges afférentes à la mise à disposition du véhicule : - Frais d'entretien du véhicule, - Impôts et taxes liés au véhicule, - Les frais d'essence, - L'assurance du véhicule.", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(1);

        $section->addText("1.7 - Clause en cas de litige", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("Les parties conviennent expressément que tout litige pouvant naître de l'exécution du présent contrat relèvera de la compétence du tribunal de commerce de {$agency->city}.", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(2);

        // Signatures
        $section->addText("Fait en deux exemplaires originaux remis à chacune des parties,", ['name' => 'Arial', 'size' => 12]);
        $section->addText("A {$agency->city}, le " . Carbon::now()->format('d/m/Y'), ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(2);

        $section->addText("Le locataire", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("signature précédée de la mention manuscrite", ['name' => 'Arial', 'size' => 12]);
        $section->addText("bon pour accord", ['name' => 'Arial', 'size' => 12]);

        $section->addTextBreak(2);

        $section->addText("Le loueur", ['name' => 'Arial', 'size' => 12, 'bold' => true]);
        $section->addText("signature précédée de la mention manuscrite", ['name' => 'Arial', 'size' => 12]);
        $section->addText("bon pour accord", ['name' => 'Arial', 'size' => 12]);

        $filename = 'contract-' . Carbon::now()->format('Y-m-d-H-i-s') . '.docx';
        $path = storage_path('app/contracts/' . $filename);

        // Save the document
        $phpWord->save($path, 'Word2007', true);

        return (object)[
            'getPath' => $path,
            'getFilename' => $filename
        ];
    }
}
