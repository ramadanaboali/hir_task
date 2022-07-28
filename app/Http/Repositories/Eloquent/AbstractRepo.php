<?php

namespace App\Http\Repositories\Eloquent;

use App\Http\Repositories\Interfaces\AbstractRepoInterface;
use App\Http\Requests\PaginateRequest;
use App\Http\Requests\UploaderRequest;
use App\User;
use Twilio\Rest\Client;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;


class AbstractRepo implements AbstractRepoInterface
{
    protected $model;

    public function __construct(string $model)
    {
        $this->model = $model;
    }

    public function findOrFail($id)
    {
        return $this->model::findOrfail($id);
    }
    public function find($id)
    {
        return $this->model::find($id);
    }
    public function getAll()
    {
        return $this->model::get();
    }
    public function findWhere($column, $value)
    {
        return $this->model::where($column, $value)->get();
    }
    public function findWhereIn($column,Array $values)
    {
        return $this->model::whereIn($column, $values)->get();
    }
    public function getWhereOperand($column, $operand, $value)
    {
        return $this->model::where($column,$operand, $value)->get();
    }


    public function findWhereFirst($column, $value)
    {
        return $this->model::where($column, $value)->firstOrFail();
    }

    public function Paginate(array $input, array $wheres, $model = null)
    {
        $currentPage = $input["offset"];
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
        $this->model = new $this->model;
        if ($input["deleted"] != "false") {
            $this->model = $this->model->onlyTrashed();
        }
        if (count($wheres)) {
            foreach ($wheres as $where) {
                switch ($where[1]) {
                    case 'in':
                        $this->model = $this->model->whereIn($where[0], $where[2]);
                        break;
                    default:
                        $this->model = $this->model->where($where[0], $where[1], $where[2]);
                }
            }
            $this->model = $this->model->orderBy($input["field"], $input["sort"]);
            return $input["paginate"] != "false" ? $this->model->paginate($input["limit"]) : $this->model->get();
        }
        $this->model = $this->model->orderBy($input["field"], $input["sort"]);
        return $input["paginate"] != "false"? $this->model->paginate($input["limit"]) : $this->model->get();
    }

    public function bulkDelete(array $ids)
    {
        $allRows = $this->model::withTrashed()->find($ids);
        foreach ($allRows as $row) {

            if ($row->trashed()) {
                $row->forceDelete();
            } else {

                $row->delete();

            }
        }
        return true;

    }


    public function bulkRestore(array $ids)
    {
        $allRows = $this->model::onlyTrashed()->find($ids);
        foreach ($allRows as $row) {
            $row->restore();
        }
        return true;

    }

    public function inputs(Array $request)
    {
        return [
            'limit' => $request['limit'] ?? 20,
            'offset' => $request['offset'] ?? 0,
            'sort' => $request['sort'] ?? 'ASC',
            'resource' => $request['resource'] ?? 'all',
            'field' => $request['field'] ?? 'id',
            'deleted' => $request['deleted'] ?? "false",
            'paginate' => $request['paginate'] ?? "true",
            'columns' => $request['columns'] ?? [],
            'operand' => $request['operand'] ?? [],
            'column_values' => $request['column_values'] ?? [],
        ];

    }

    public function whereOptions($input, $columns)
    {
        $wheres = [];
        $x = 0;

        foreach ($input["columns"] as $row) {
            if (in_array($row, array_values($columns))) {


                if (strtolower($input["operand"][$x]) == "like") {
                    $wheres[] = [$row, strtolower($input["operand"][$x]), '%' . $input["column_values"][$x] . '%'];
                } else {
                    $wheres[] = [$row, strtolower($input["operand"][$x]), $input["column_values"][$x]];
                }

                $x++;
            }
        }

        return $wheres;
    }

    public function create($data)
    {
        return $this->model::create($data);
    }

    public function update($data, $item)
    {

        return $item->update($data);
    }
    public function storeFile($image, $destination_path)
    {
        $fileName = time() . rand(0, 999999999) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs($destination_path, $fileName);
        $path = url('/storage') . '/' . str_replace('public/', '', $path);
        return   $fileName;

    }


    public function Uploader(UploaderRequest $request)
    {
        if ($request->hasFile('file')) {
            if (!empty($request->input('folder'))) {
                $destination_path = 'public/media/' . $request->folder;
            } else {
                $destination_path = 'public/media';
            }
            $image = $request->file('file');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('file')->storeAs($destination_path, $fileName);
            $path = url('/storage') . '/' . str_replace('public/', '', $path);
            return $path;
        }
    }

    public function sendSMS(string $sms_mobile, string $sms_message)
    {
        $sms_api_web = env('sms_api_web');
        $sms_api_v2 = env('sms_api_v2');
        $sms_username = env('sms_username');
        $sms_password = env('sms_password');
        $sms_language = env('sms_language');
        $sms_sender = env('sms_sender');
        return Http::post($sms_api_web."username=$sms_username&password=$sms_password&language=$sms_language&sender=$sms_sender&mobile=2$sms_mobile&message=$sms_message", []);

    }
    public function smsTwillio(string $phone, string $message)
    {
        $account_sid = env('sms_twillio_account_sid');
        $auth_token = env('sms_twillio_auth_token');

        $twilio_number = env('sms_twillio_twilio_number');

        $client = new Client($account_sid, $auth_token);

        $result=$client->messages->create(
            "+2".$phone,
            array(
                'from' => 'smart_home',
                'body' => $message
            )
        );
        return $result;

    }

    public function getDeviceTokens($ids)
    {
        $devices = User::select('fcm_token')->find($ids);
        $tokens = array();
        $temp = [];
        $temp=$devices->fcm_token;
        array_push($tokens, $temp);

        return $tokens;
    }



    public function send_notification($registration_ids,$message)
    {
        $API_KEY = env('firbase_token');
        $msg = array
            (
                'body' 	  => $message,
                'title'    => "new message",
                'vibrate'  => 1,
                'sound'    => 1,
            );

        $fields = array
            (
            'registration_ids'=> $registration_ids,
            'notification'	=> $msg,

            );
        $headers = array
            (
            'Authorization: key=' .    $API_KEY,
            'Content-Type: application/json'
            );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        return $result = curl_exec($ch );
        curl_close( $ch );
    }

    public  function generateRandomString($length = 20) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
