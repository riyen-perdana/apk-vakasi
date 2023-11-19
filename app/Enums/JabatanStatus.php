<?php

namespace App\Enums;

enum JabatanStatus: string
{
    case Dekan = 'Dekan';
    case Bendahara_Pengeluaran = 'Bendahara Pengeluaran';
    case Pejabat_Pembuat_Komitmen = 'Pejabat Pembuat Komitmen';
    case PPK_RM = 'PPK RM';
    case BPP_Rupiah_Murni = 'BPP Rupiah Murni';
}
