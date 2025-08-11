<?php

$actionFiles = glob('app/Actions/**/*.php', GLOB_BRACE);

$additionalTransformations = [
    // Remaining Portuguese messages
    'flash()->addSuccess(\'Hotel excluído com sucesso\')' => 'flash()->addSuccess(__(\'messages.hotel_deleted_success\'))',
    'flash()->addError(\'Erro ao excluir hotel\')' => 'flash()->addError(__(\'messages.hotel_delete_error\'))',
    'flash()->addSuccess(\'Banner deletado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.banner_deleted_success\'))',
    'flash()->addError(\'Erro ao deletar banner!\')' => 'flash()->addError(__(\'messages.banner_delete_error\'))',
    'flash()->addSuccess(\'Mensagem deletada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.message_deleted_success\'))',
    'flash()->addError(\'Erro ao deletar mensagem!\')' => 'flash()->addError(__(\'messages.message_delete_error\'))',
    'flash()->addSuccess(\'Imovel actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.property_updated_success\'))',
    'flash()->addError(\'Erro na actualização do imovel.\')' => 'flash()->addError(__(\'messages.property_update_error\'))',
    'flash()->addSuccess(\'Imagens carregadas com sucesso\')' => 'flash()->addSuccess(__(\'messages.image_uploaded_success\'))',
    'flash()->addError(\'Erro ao carregar imagens\')' => 'flash()->addError(__(\'messages.image_upload_error\'))',
    'flash()->addSuccess(\'Condição do imóvel actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.condition_updated_success\'))',
    'flash()->addError(\'Erro na actualização da condição do imóvel.\')' => 'flash()->addError(__(\'messages.condition_update_error\'))',
    'flash()->addSuccess(\'Condição do imovel deletada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.condition_deleted_success\'))',
    'flash()->addError(\'Erro ao deletar condição do imovel.\')' => 'flash()->addError(__(\'messages.condition_delete_error\'))',
    'flash()->addError(\'Erro ao deletar: Não pode deletar uma condição de imovel que esta sendo usado em imóveis!\')' => 'flash()->addError(__(\'messages.condition_delete_has_properties\'))',
    'flash()->addSuccess(\'Condição do imóvel criada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.condition_created_success\'))',
    'flash()->addSuccess(\'Province created successfcul.\')' => 'flash()->addSuccess(__(\'messages.province_created_success\'))',
    'flash()->addError(\'Erro na actualização do status.\')' => 'flash()->addError(__(\'messages.status_update_error\'))',
    
    // Additional patterns that might be missed
    'flash()->addSuccess(\'Hotel criado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.hotel_created_success\'))',
    'flash()->addError(\'Erro ao criar hotel.\')' => 'flash()->addError(__(\'messages.hotel_create_error\'))',
    'flash()->addSuccess(\'Hotel actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.hotel_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar hotel.\')' => 'flash()->addError(__(\'messages.hotel_update_error\'))',
    'flash()->addSuccess(\'Quarto actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.room_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar quarto.\')' => 'flash()->addError(__(\'messages.room_update_error\'))',
    'flash()->addSuccess(\'Quarto deletado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.room_deleted_success\'))',
    'flash()->addError(\'Erro ao deletar quarto.\')' => 'flash()->addError(__(\'messages.room_delete_error\'))',
    'flash()->addSuccess(\'Quarto anexado ao hotel com sucesso.\')' => 'flash()->addSuccess(__(\'messages.room_attached_success\'))',
    'flash()->addError(\'Erro ao anexar quarto ao hotel.\')' => 'flash()->addError(__(\'messages.room_attach_error\'))',
    'flash()->addSuccess(\'Mensagem enviada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.message_sent_success\'))',
    'flash()->addError(\'Erro ao enviar mensagem.\')' => 'flash()->addError(__(\'messages.message_send_error\'))',
    'flash()->addSuccess(\'Estado da mensagem actualizado com sucesso.\')' => 'flash()->addSuccess(__(\'messages.message_status_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar estado da mensagem.\')' => 'flash()->addError(__(\'messages.message_status_update_error\'))',
    'flash()->addSuccess(\'Página actualizada com sucesso.\')' => 'flash()->addSuccess(__(\'messages.page_updated_success\'))',
    'flash()->addError(\'Erro ao actualizar página.\')' => 'flash()->addError(__(\'messages.page_update_error\'))',
];

foreach ($actionFiles as $file) {
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Transform additional messages
    foreach ($additionalTransformations as $old => $new) {
        $content = str_replace($old, $new, $content);
    }
    
    // Fix some specific method parameter issues that might exist
    $content = preg_replace('/public function __invoke\((.*?)\s*,\s*Request\s+\$request\)/', 'public function __invoke($1, Request $request)', $content);
    
    // Make sure we add Illuminate\Http\Request if not present and needed
    if (strpos($content, '__invoke') !== false && strpos($content, 'Request $request') !== false && strpos($content, 'use Illuminate\Http\Request;') === false) {
        $content = preg_replace('/(<\?php\s*\n\s*namespace [^;]+;\s*\n)/', '$1' . "\n" . 'use Illuminate\Http\Request;' . "\n", $content);
    }
    
    // Only write if content changed
    if ($content !== $originalContent) {
        echo "Additional transformations applied to: $file\n";
        file_put_contents($file, $content);
    }
}

echo "Additional transformations complete!\n";
