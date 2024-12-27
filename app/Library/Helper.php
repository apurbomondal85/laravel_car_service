<?php

namespace App\Library;

use App\Models\ActivityLog;
use App\Models\ClubMember;
use App\Models\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Image;
use Carbon\Carbon;

class Helper
{
    public static function log($error)
    {
        Log::error($error);
    }

    public static function uploadImage($image, $path, $w = null, $h = null)
    {
        $file_name = time() . rand(111, 999) . '.' . $image->getClientOriginalExtension();
        $destination_path = public_path($path);

        if(!is_dir($destination_path)) {
            mkdir($destination_path, 0777, true);
        }

        $image_file = Image::make($image->getRealPath());

        if($w && $h) {
            $image_file->resize($w, $h, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $image_file->save($destination_path . '/' . $file_name);

        return $path . '/' . $file_name;
    }

    public static function getPublicUrl($url)
    {
        return url($url);
    }

    public static function getClientIp()
    {
        $ipaddress = '';

        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif(getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif(getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif(getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

    public static function getGeoInfo()
    {
        $ip = self::getClientIp();

        if($ip == '::1') {
            $data = @unserialize(file_get_contents('http://ip-api.com/php/'));
        } else {
            $data = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
        }

        if ($data && $data['status'] == 'success') {
            return $data;
        }

        return false;
    }

    public static function uploadFile($requested_file, $path)
    {
        if (!empty($requested_file) && $requested_file != 'null') :
            $extension = $requested_file->getClientOriginalExtension();
            $originalFile = date('YmdHis') . "_original_" . rand(1, 500) . '.' . $extension;
            $directory = $path . '/';
            File::ensureDirectoryExists($directory, 0777, true);
            $originalFileUrl = $directory . $originalFile;
            $requested_file->move($directory, $originalFile);

            return $originalFileUrl;
        else:
            return false;
        endif;
    }

    public static function replaceMessageWithSystemShortcodes(string $message)
    {
        $system_shortcodes = Enum::systemShortcodesWithValues();

        foreach ($system_shortcodes as $shortcode => $value) {
            $regex = "/{{(\s*)$shortcode(\s*)}}/";
            $message = preg_replace($regex, $value, $message);
        }

        return $message;
    }

    public static function replaceWithUrl(string $text)
    {
        $p = "/(http|https|ftp|ftps)/";

        if(preg_match($p, $text, $url)) {
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        } else {
            $text = preg_replace("/www\./", "http://www.", $text);
            $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        }

        if(preg_match($reg_exUrl, $text, $url)) {
            echo preg_replace($reg_exUrl, '<a target=\"_blank\" href="' . $url[0] . '" rel="nofollow">' . $url[0] . '</a>', $text);
        } else {
            echo $text;
        }
    }

    /**
     * Create activity log
     *
     * @param string $action
     * @param string $subject
     * @param string $difference
     * @param string $ip
     * @param string $browser
     *
     * @return void
     */
    public static function createActivityLog($action, $subject, $recordId, $difference, $ip, $browser)
    {
        ActivityLog::create([
            'action_by' => auth()->id() ?? null,
            'log_time'  => now(),
            'record_id' => $recordId,
            'action'    => $action,
            'subject'   => $subject,
            'changes'   => $difference,
            'ip'        => $ip,
            'browser'   => $browser
        ]);
    }

    public static function getCountries()
    {
        return include(__DIR__ . '/../Files/Countries.php');
    }

    public static function getCountryName($country_short_name)
    {
        $countries = Helper::getCountries();

        return $countries[$country_short_name]['name'] ?? '';
    }

    /**
     * Format given date
     *
     * @param mixed $date
     * @param string $format
     *
     * @return static
     */
    public static function getDateFormat($date, $format)
    {
        return Carbon::parse($date)->format($format);
    }

    /**
     * Return matched class by status
     *
     * @param string $status
     *
     * @return string
     */
    public static function getBgColorClass($status)
    {
        $statusList = [
            'Active'    => 'card-dark-blue',
            'Approved'  => 'card-dark-blue',
            'Completed' => 'card-dark-blue',
            'Inactive'  => 'card-light-blue',
            'Pending'   => 'card-tale',
            'Declined'  => 'card-light-danger',
            'Suspended' => 'card-light-danger',
            'Hold'      => 'card-light-blue',
            'Closed'    => 'card-dark-blue',
            'Open'      => 'card-tale',
        ];

        return $statusList[$status] ? $statusList[$status] : '';
    }

    /**
     * Return matched class by status
     *
     * @param string $status
     *
     * @return string
     */
    public static function getColorClass($status)
    {
        $statusList = [
            'Active'    => 'primary',
            'Approved'  => 'success',
            'Completed' => 'success',
            'Inactive'  => 'warning',
            'Pending'   => 'warning',
            'Declined'  => 'danger',
            'Suspended' => 'danger',
            'Hold'      => 'warning',
            'Closed'    => 'success',
            'Open'      => 'primary',
        ];

        return $statusList[$status] ? $statusList[$status] : '';
    }

    /*
     * Return the difference of before and after
     *
     * @param object $model
     * @param boolean $update
     *
     * @return array
     */
    public static function getDifference($model, $update = false, $created = false)
    {
        if ($created) {
            return json_encode([
                'before' => $model,
                'after'  => ''
            ], true);
        }

        if ($update) {
            $changed = $model->getDirty();

            return json_encode([
                'before' => array_intersect_key($model->getOriginal(), $changed),
                'after'  => $changed
            ], true);
        }

        return json_encode([
            'before' => $model->id,
            'after'  => ''
        ], true);
    }

    public static function getCommitteeSeason()
    {
        return array_reverse(Config::getDropdowns(Enum::CONFIG_DROPDOWN_SEASON));
    }

    public static function getDesignationByKey(string $key)
    {
        return Enum::getCommitteeDesignation()[$key];
    }

    public static function getClubDesignationByKey(string $key)
    {
        return Enum::getClubCommitteeDesignation()[$key];
    }

    public static function getClubPrecedentByClubId(int $id)
    {
        return ClubMember::where('club_id', $id)->where('designation', Enum::CLUB_COMMITTEE_PRESIDENT)->first();
    }

    public static function getClubCommitteeByClubId(int $id)
    {
        return ClubMember::where('club_id', $id)->where('designation', '!=', null)->orderBy('id', 'ASC')->get();
    }


    public static function uploadDocument($doc, $path, $w = null, $h = null)
    {
        $doc_type = $doc->getClientMimeType();

        if($doc_type == 'image/*') {
            $data = self::uploadImage($doc, $path, $w, $h);
        } else {
            $data = self::uploadFile($doc, $path);
        }

        return $data;
    }

    public static function getRoleOfHonors()
    {
        return include(__DIR__ . '/../Files/RoleOfHonor.php');
    }


    public static function getAttachment($attachment): string
    {
        $file_extension = $attachment->getClientOriginalExtension();

        if ($file_extension == 'pdf') {
            return Helper::uploadFile($attachment, Enum::ATTACHMENT_FILE_DIR);
        }

        return Helper::uploadImage($attachment, Enum::ATTACHMENT_FILE_DIR);
    }
}
