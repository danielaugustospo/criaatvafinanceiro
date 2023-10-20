<?php

namespace App\Http\Requests\PedidoCompra;

use Illuminate\Foundation\Http\FormRequest;

class PedidoAVistaRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Certifique-se de definir isso como true para autorizar a solicitação.
    }

    public function rules()
    {
        return [
            'ped_pix' => 'required_if:ped_formapag,avista',
            'ped_favorecido' => 'required_if:ped_formapag,avista',
            'ped_banco' => 'required',
            'ped_conta' => 'required',
            'ped_agenciaconta' => 'required',
            'ped_cpfcnpj' => 'required_if:ped_banco,180|cpf_cnpj',
        ];
    }

    public function messages()
    {
        return [
            'ped_pix.required_if' => 'Preencha o PIX',
            'ped_favorecido.required_if' => 'Preencha o favorecido da chave PIX',
            'ped_banco.required' => 'Nome do Banco é obrigatório',
            'ped_conta.required' => 'Informe a conta',
            'ped_agenciaconta.required' => 'Informe a agência',
            'ped_cpfcnpj.required_if' => 'CPF/CNPJ obrigatório',
        ];
    }
}
