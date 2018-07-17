<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Bill;

class ChartController extends Controller
{
    public function fullDate() {
        $user_id = Auth::user()->id;
        $bills =  DB::table('bills')->select('date', 'sum')->where('user_id', $user_id)->get();
        $dateSum = $bills->sortBy('date')->groupBy('date')->map(function ($row, $key) {
            return $row->sum('sum');
        });
        $result = collect([]);
        foreach ($dateSum as $key => $value) {
            $newObject = (object) [
                'date' => $key,
                'sum' => $value,
            ];
            $result->push($newObject);
        }
        return response()->json($result);
    }

    public function tag() {
        $user_id = Auth::user()->id;
        $bills = Bill::with('tag')->where('user_id', 1)->get();
        $tagSum = $bills->sortBy('tag.name')->groupBy('tag.name')->map(function ($row, $key) {
           return $row->sum('sum');
        });
        $result = collect([]);
        foreach ($tagSum as $key => $value) {
            $newObject = (object) [
                'tag' => $key,
                'sum' => $value,
            ];
            $result->push($newObject);
        }
        return response()->json($result);
    }
}
