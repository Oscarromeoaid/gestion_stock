<?php
// app/Exports/MouvementsExport.php

namespace App\Exports;

use App\Models\Mouvement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MouvementsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Mouvement::with(['produit', 'user']);

        if (isset($this->filters['type']) && $this->filters['type']) {
            $query->where('type', $this->filters['type']);
        }
        if (isset($this->filters['produit_id']) && $this->filters['produit_id']) {
            $query->where('produit_id', $this->filters['produit_id']);
        }
        if (isset($this->filters['date_debut']) && $this->filters['date_debut']) {
            $query->whereDate('date_mouvement', '>=', $this->filters['date_debut']);
        }
        if (isset($this->filters['date_fin']) && $this->filters['date_fin']) {
            $query->whereDate('date_mouvement', '<=', $this->filters['date_fin']);
        }

        return $query->orderBy('date_mouvement', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Date',
            'Produit',
            'SKU',
            'Type',
            'Quantité',
            'Motif',
            'Utilisateur',
        ];
    }

    public function map($mouvement): array
    {
        return [
            $mouvement->date_mouvement->format('d/m/Y H:i'),
            $mouvement->produit->nom,
            $mouvement->produit->sku,
            $mouvement->type === 'entree' ? 'Entrée' : 'Sortie',
            $mouvement->quantite,
            $mouvement->motif ?? '-',
            $mouvement->user->name,
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
            'A' => 18,
            'B' => 30,
            'C' => 15,
            'D' => 12,
            'E' => 12,
            'F' => 35,
            'G' => 20,
        ];
    }
}