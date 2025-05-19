<?php

namespace App\Http\Controllers;

use App\Helpers\CalculatorHelper;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index(Request $request)
    {
        $result = null;
        $error = null;

        if ($request->has(['a', 'b', 'operator'])) {
            $a = $request->input('a');
            $b = $request->input('b');
            $operator = $request->input('operator');

            // Validasi angka positif
            if ($a < 0 || $b < 0) {
                $error = "Input harus berupa angka positif.";
            } else {
                switch ($operator) {
                    case 'tambah':
                        $result = $a + $b;
                        break;
                    case 'kurang':
                        $result = $a - $b;
                        break;
                    // tambahkan operator lain jika ada
                }
            }
        }

        return view('calculator', compact('result', 'error'));
    }

    public function calculate(Request $request)
    {
        $a = $request->input('a');
        $b = $request->input('b');
        $operation = $request->input('operation');

        // Validasi angka positif
        if ($a < 0 || $b < 0) {
            return view('calculator', [
                'error' => 'Input harus berupa angka positif.',
                'a' => $a,
                'b' => $b,
                'operation' => $operation
            ]);
        }

        // Proses perhitungan
        $result = null;
        if ($operation == 'add') {
            $result = $a + $b;
        } elseif ($operation == 'subtract') {
            $result = $a - $b;
        }

        return view('calculator', [
            'result' => $result,
            'a' => $a,
            'b' => $b,
            'operation' => $operation
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'a' => 'required|numeric|min:0',
            'b' => 'required|numeric|min:0',
        ]);

        $result = $request->a + $request->b;
        return response()->json(['result' => $result]);
    }
}
