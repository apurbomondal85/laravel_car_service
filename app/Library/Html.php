<?php

namespace App\Library;

class Html
{
    public static function linkBack(string $route)
    {
        return '<a href="' . $route . '" class="btn btn-sm btn2-secondary btn-back "><i class="fas fa-long-arrow-alt-left"></i> Back</a>';
    }

    public static function linkAdd(string $route, string $label, string $size = 'btn-sm')
    {
        return '<a href="' . $route . '" class="btn btn-sm btn2-secondary ' . $size . '"><i class="fas fa-plus"></i> ' . $label . '</a>';
    }

    public static function btnSubmit($size = '')
    {
        return '<button type="submit" class="btn my-3 btn2-secondary ' . $size . '"><i class="fas fa-save"></i> Save </button>';
    }

    public static function btnReset()
    {
        return '<button type="reset" class="btn mr-3 my-3 btn2-light-secondary"><i class="fas fa-sync-alt"></i> Reset</button>';
    }

    public static function btnClose()
    {
        return '<button type="button" class="btn btn2-light-secondary my-3 mr-3" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>';
    }

    public static function ticketStatus(int $value, string $size = 'btn-sm')
    {
        if(Enum::TICKET_STATUS_OPEN == $value) {
            $badge = '<span class="badge bg-success">' . Enum::getTicketStatus()[Enum::TICKET_STATUS_OPEN] . '</span>';
        } elseif(Enum::TICKET_STATUS_HOLD == $value) {
            $badge = '<span class="badge bg-warning text-dark">' . Enum::getTicketStatus()[Enum::TICKET_STATUS_HOLD] . '</span>';
        } elseif(Enum::TICKET_STATUS_CLOSED == $value) {
            $badge = '<span class="badge bg-danger">' . Enum::getTicketStatus()[Enum::TICKET_STATUS_CLOSED] . '</span>';
        } else {
            $badge = '<span class="badge bg-secondary">N/A</span>';
        }

        return $badge;
    }

}
