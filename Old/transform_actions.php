<?php

require_once 'vendor/autoload.php';

$actionFiles = glob('app/Actions/**/*.php', GLOB_BRACE);

$transformations = [
    // Flash messages transformation
    'flash()->addSuccess(\'Usuario criado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.user_created_success\'))',
    'flash()->addError(\'Erro ao criar usuário.\')' => 'flash()->addError(__(\'messages.user_create_error\'))',
    'flash()->addSuccess(\'Usuário actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.user_updated_success\'))',
    'flash()->addError(\'Erro na actualização do usuário.\')' => 'flash()->addError(__(\'messages.user_update_error\'))',
    'flash()->addSuccess(\'Usuário habilitado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.user_enabled_success\'))',
    'flash()->addSuccess(\'Usuário desabilitado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.user_disabled_success\'))',
    'flash()->addError(\'Erro ao traocar o estado do usuario\')' => 'flash()->addError(__(\'messages.user_status_change_error\'))',
    
    // Status messages
    'flash()->addSuccess(\'Status criado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.status_created_success\'))',
    'flash()->addError(\'Erro ao criar status.\')' => 'flash()->addError(__(\'messages.status_create_error\'))',
    'flash()->addSuccess(\'Status actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.status_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar o status.\')' => 'flash()->addError(__(\'messages.status_update_error\'))',
    'flash()->addSuccess(\'Status removido com sucesso.\')' => 'flash()->addSuccess(__(\'messages.status_deleted_success\'))',
    'flash()->addError(\'Erro ao remover o status.\')' => 'flash()->addError(__(\'messages.status_delete_error\'))',
    
    // Business rules messages
    'flash()->addSuccess(\'Regra de negócio criada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.business_rule_created_success\'))',
    'flash()->addError(\'Erro ao criar regra de negócio.\')' => 'flash()->addError(__(\'messages.business_rule_create_error\'))',
    'flash()->addSuccess(\'Regra de negócio actualizada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.business_rule_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar regra de negócio.\')' => 'flash()->addError(__(\'messages.business_rule_update_error\'))',
    'flash()->addSuccess(\'Regra de negócio removida com sucesso.\')' => 'flash()->addSuccess(__(\'messages.business_rule_deleted_success\'))',
    'flash()->addError(\'Erro ao remover regra de negócio.\')' => 'flash()->addError(__(\'messages.business_rule_delete_error\'))',
    
    // Transaction type messages
    'flash()->addSuccess(\'Tipo de transação criado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.transaction_type_created_success\'))',
    'flash()->addError(\'Erro ao criar tipo de transação.\')' => 'flash()->addError(__(\'messages.transaction_type_create_error\'))',
    'flash()->addSuccess(\'Tipo de transação actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.transaction_type_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar tipo de transação.\')' => 'flash()->addError(__(\'messages.transaction_type_update_error\'))',
    'flash()->addSuccess(\'Tipo de transação removido com sucesso.\')' => 'flash()->addSuccess(__(\'messages.transaction_type_deleted_success\'))',
    'flash()->addError(\'Erro ao remover tipo de transação.\')' => 'flash()->addError(__(\'messages.transaction_type_delete_error\'))',
    
    // City messages
    'flash()->addSuccess(\'Cidade criada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.city_created_success\'))',
    'flash()->addError(\'Erro ao criar cidade.\')' => 'flash()->addError(__(\'messages.city_create_error\'))',
    'flash()->addSuccess(\'Cidade actualizada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.city_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar cidade.\')' => 'flash()->addError(__(\'messages.city_update_error\'))',
    'flash()->addSuccess(\'Cidade removida com sucesso.\')' => 'flash()->addSuccess(__(\'messages.city_deleted_success\'))',
    'flash()->addError(\'Erro ao remover cidade.\')' => 'flash()->addError(__(\'messages.city_delete_error\'))',
    'flash()->addError(\'Erro ao apagar: Cidade tem imóveis!\')' => 'flash()->addError(__(\'messages.city_delete_has_imovels\'))',
    
    // Province messages
    'flash()->addSuccess(\'Província criada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.province_created_success\'))',
    'flash()->addError(\'Erro ao criar província.\')' => 'flash()->addError(__(\'messages.province_create_error\'))',
    'flash()->addSuccess(\'Província actualizada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.province_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar província.\')' => 'flash()->addError(__(\'messages.province_update_error\'))',
    'flash()->addSuccess(\'Província removida com sucesso.\')' => 'flash()->addSuccess(__(\'messages.province_deleted_success\'))',
    'flash()->addError(\'Erro ao remover província.\')' => 'flash()->addError(__(\'messages.province_delete_error\'))',
    'flash()->addError(\'Erro ao apagar: Província tem cidades!\')' => 'flash()->addError(__(\'messages.province_delete_has_cities\'))',
    
    // Property messages
    'flash()->addSuccess(\'Imóvel criado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.property_created_success\'))',
    'flash()->addError(\'Erro ao criar imóvel.\')' => 'flash()->addError(__(\'messages.property_create_error\'))',
    'flash()->addSuccess(\'Imóvel actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.property_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar imóvel.\')' => 'flash()->addError(__(\'messages.property_update_error\'))',
    'flash()->addSuccess(\'Imóvel removido com sucesso.\')' => 'flash()->addSuccess(__(\'messages.property_deleted_success\'))',
    'flash()->addError(\'Erro ao remover imóvel.\')' => 'flash()->addError(__(\'messages.property_delete_error\'))',
    'flash()->addSuccess(\'Imóvel aprovado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.property_approved_success\'))',
    'flash()->addError(\'Erro ao aprovar imóvel.\')' => 'flash()->addError(__(\'messages.property_approve_error\'))',
    
    // Hotel messages
    'flash()->addSuccess(\'Hotel criado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.hotel_created_success\'))',
    'flash()->addError(\'Erro ao criar hotel.\')' => 'flash()->addError(__(\'messages.hotel_create_error\'))',
    'flash()->addSuccess(\'Hotel actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.hotel_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar hotel.\')' => 'flash()->addError(__(\'messages.hotel_update_error\'))',
    'flash()->addSuccess(\'Hotel removido com sucesso.\')' => 'flash()->addSuccess(__(\'messages.hotel_deleted_success\'))',
    'flash()->addError(\'Erro ao remover hotel.\')' => 'flash()->addError(__(\'messages.hotel_delete_error\'))',
    
    // Room messages
    'flash()->addSuccess(\'Quarto adicionado ao hotel com sucesso.\')' => 'flash()->addSuccess(__(\'messages.room_attached_success\'))',
    'flash()->addError(\'Erro ao adicionar quarto ao hotel.\')' => 'flash()->addError(__(\'messages.room_attach_error\'))',
    'flash()->addSuccess(\'Quarto actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.room_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar quarto.\')' => 'flash()->addError(__(\'messages.room_update_error\'))',
    'flash()->addSuccess(\'Quarto removido com sucesso.\')' => 'flash()->addSuccess(__(\'messages.room_deleted_success\'))',
    'flash()->addError(\'Erro ao remover quarto.\')' => 'flash()->addError(__(\'messages.room_delete_error\'))',
    
    // Condition messages
    'flash()->addSuccess(\'Condição criada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.condition_created_success\'))',
    'flash()->addError(\'Erro ao criar condição.\')' => 'flash()->addError(__(\'messages.condition_create_error\'))',
    'flash()->addSuccess(\'Condição actualizada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.condition_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar condição.\')' => 'flash()->addError(__(\'messages.condition_update_error\'))',
    'flash()->addSuccess(\'Condição removida com sucesso.\')' => 'flash()->addSuccess(__(\'messages.condition_deleted_success\'))',
    'flash()->addError(\'Erro ao remover condição.\')' => 'flash()->addError(__(\'messages.condition_delete_error\'))',
    
    // Intermediation rule messages
    'flash()->addSuccess(\'Regra de intermediação criada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.intermediation_rule_created_success\'))',
    'flash()->addError(\'Erro ao criar regra de intermediação.\')' => 'flash()->addError(__(\'messages.intermediation_rule_create_error\'))',
    'flash()->addSuccess(\'Regra de intermediação actualizada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.intermediation_rule_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar regra de intermediação.\')' => 'flash()->addError(__(\'messages.intermediation_rule_update_error\'))',
    'flash()->addSuccess(\'Regra de intermediação removida com sucesso.\')' => 'flash()->addSuccess(__(\'messages.intermediation_rule_deleted_success\'))',
    'flash()->addError(\'Erro ao remover regra de intermediação.\')' => 'flash()->addError(__(\'messages.intermediation_rule_delete_error\'))',
    
    // Page messages
    'flash()->addSuccess(\'Página actualizada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.page_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar página.\')' => 'flash()->addError(__(\'messages.page_update_error\'))',
    
    // Banner messages
    'flash()->addSuccess(\'Banner carregado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.banner_uploaded_success\'))',
    'flash()->addError(\'Erro ao carregar banner.\')' => 'flash()->addError(__(\'messages.banner_upload_error\'))',
    'flash()->addSuccess(\'Banner removido com sucesso.\')' => 'flash()->addSuccess(__(\'messages.banner_deleted_success\'))',
    'flash()->addError(\'Erro ao remover banner.\')' => 'flash()->addError(__(\'messages.banner_delete_error\'))',
    
    // Message messages
    'flash()->addSuccess(\'Mensagem removida com sucesso.\')' => 'flash()->addSuccess(__(\'messages.message_deleted_success\'))',
    'flash()->addError(\'Erro ao remover mensagem.\')' => 'flash()->addError(__(\'messages.message_delete_error\'))',
    'flash()->addSuccess(\'Mensagem enviada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.message_sent_success\'))',
    'flash()->addError(\'Erro ao enviar mensagem.\')' => 'flash()->addError(__(\'messages.message_send_error\'))',
    'flash()->addSuccess(\'Estado da mensagem actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.message_status_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar estado da mensagem.\')' => 'flash()->addError(__(\'messages.message_status_update_error\'))',
];

foreach ($actionFiles as $file) {
    $content = file_get_contents($file);
    
    // Skip if file doesn't contain AsController
    if (strpos($content, 'AsController') === false) {
        continue;
    }
    
    echo "Transforming: $file\n";
    
    // Remove AsController imports and traits
    $content = preg_replace('/use Lorisleiva\\\\Actions\\\\Concerns\\\\AsController;/', '', $content);
    $content = preg_replace('/use Lorisleiva\\\\Actions\\\\Concerns\\\\AsAction;/', '', $content);
    $content = preg_replace('/use AsController;/', '', $content);
    $content = preg_replace('/use AsAction;/', '', $content);
    
    // Replace ActionRequest with Request
    $content = str_replace('use Lorisleiva\Actions\ActionRequest;', 'use Illuminate\Http\Request;', $content);
    $content = str_replace('ActionRequest', 'Request', $content);
    
    // Transform asController methods to __invoke
    $content = preg_replace('/public function asController\(/i', 'public function __invoke(', $content);
    $content = preg_replace('/public function AsController\(/i', 'public function __invoke(', $content);
    
    // Transform flash messages
    foreach ($transformations as $old => $new) {
        $content = str_replace($old, $new, $content);
    }
    
    // Clean up extra newlines
    $content = preg_replace('/\n\s*\n\s*\n/', "\n\n", $content);
    
    file_put_contents($file, $content);
}

echo "Transformation complete!\n";
