<?php

namespace App\Http\Requests;

use App\Xm\Contracts\ICompaniesFetcher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class HistoryGetRequest extends FormRequest
{
    protected ICompaniesFetcher $companiesFetcher;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(ICompaniesFetcher $companiesFetcher): array
    {
        $this->companiesFetcher = $companiesFetcher;

        return [
            'symbol' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date|before_or_equal:today',
            'end_date' => 'required|date_format:Y-m-d|date|after_or_equal:start_date|before_or_equal:today',
            'email' => 'required|email',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator(Validator $validator): void
    {
        $companies = $this->companiesFetcher->getCompanies();
        $symbol = $validator->getData()['symbol'] ?? '';
        $validator->after(
            function ($validator) use ($symbol, $companies) {
                if (!$companies->get($symbol)) {
                    $validator->errors()->add(
                        'symbol',
                        'Symbol does not exist in symbols list'
                    );
                }
            }
        );
    }
}
