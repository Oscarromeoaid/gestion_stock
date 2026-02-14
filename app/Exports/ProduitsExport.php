<?php
// app/Exports/ProduitsExport.php

namespace App\Exports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProduitsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Produit::with(['categorie', 'fournisseur']);

        if (isset($this->filters['categorie_id']) && $this->filters['categorie_id']) {
            $query->where('categorie_id', $this->filters['categorie_id']);
        }
        if (isset($this->filters['stock_bas']) && $this->filters['stock_bas']) {
            $query->whereColumn('quantite', '<=', 'seuil_alerte');
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Nom',
            'Catégorie',
            'Fournisseur',
            'Prix (€)',
            'Quantité',
            'Seuil Alerte',
            'Valeur Stock (€)',
            'Statut',
        ];
    }

    public function map($produit): array
    {
        return [
            $produit->sku,
            $produit->nom,
            $produit->categorie->nom,
            $produit->fournisseur->nom,
            number_format($produit->prix, 2),
            $produit->quantite,
            $produit->seuil_alerte,
            number_format($produit->valeurStock(), 2),
            $produit->isStockBas() ? 'Stock Bas' : 'OK',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'E2E8F0']]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 30,
            'C' => 20,
            'D' => 25,
            'E' => 12,
            'F' => 12,
            'G' => 15,
            'H' => 18,
            'I' => 12,
        ];
    }
}