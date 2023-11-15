<?php

namespace App\Enums;

enum JabatanStatus: string
{
    case Dekan = 'Dekan';
    case Bendahara_Pengeluaran = 'Bendahara Pengeluaran';
    case PPK = 'Pejabat Pembuat Komitmen';
    case PPK_RM = 'PPK RM';
    case BPP_RUPIAH_MURNI = 'BPP Rupiah Murni';
}
