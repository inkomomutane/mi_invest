<?php

// Final cleanup script for Action transformations
$actionFiles = glob('app/Actions/**/*.php', GLOB_BRACE);

$filesTransformed = 0;

foreach ($actionFiles as $file) {
    $content = file_get_contents($file);
    $originalContent = $content;
    
    // Remove any remaining Lorisleiva imports
    $content = preg_replace('/use Lorisleiva\\\\Actions\\\\ActionRequest;?\s*\n?/', '', $content);
    $content = preg_replace('/use Lorisleiva\\\\Actions\\\\Concerns\\\\AsController;?\s*\n?/', '', $content);
    $content = preg_replace('/use Lorisleiva\\\\Actions\\\\Concerns\\\\AsAction;?\s*\n?/', '', $content);
    
    // Remove any remaining traits
    $content = preg_replace('/\s*use AsController;\s*\n?/', '', $content);
    $content = preg_replace('/\s*use AsAction;\s*\n?/', '', $content);
    
    // Make sure we have Request import if using __invoke with Request
    if (strpos($content, '__invoke') !== false && 
        strpos($content, 'Request $request') !== false && 
        strpos($content, 'use Illuminate\Http\Request;') === false) {
        
        // Find the namespace line and add the import after it
        $content = preg_replace(
            '/(namespace [^;]+;\s*\n)/',
            '$1' . "\n" . 'use Illuminate\Http\Request;' . "\n",
            $content
        );
    }
    
    // Fix any method calls using request() helper instead of parameter
    $content = preg_replace('/request\(\)->validate\(/', '$request->validate(', $content);
    $content = preg_replace('/request\(\)->validated\(/', '$request->validated(', $content);
    
    // Clean up any remaining Portuguese flash messages that might be missed
    $portuguesePatterns = [
        '/flash\(\)->addSuccess\(\'([^\']*(?:criado|criada|actualizado|actualizada|removido|removida|deletado|deletada|excluído|carregado|carregada|anexado|enviado|enviada)[^\']*)\'\)/' => 'flash()->addSuccess(__(\'messages.action_success\'))',
        '/flash\(\)->addError\(\'([^\']*(?:erro|Erro)[^\']*)\'\)/' => 'flash()->addError(__(\'messages.action_error\'))',
    ];
    
    foreach ($portuguesePatterns as $pattern => $replacement) {
        $content = preg_replace($pattern, $replacement, $content);
    }
    
    // Clean up multiple blank lines
    $content = preg_replace('/\n\s*\n\s*\n/', "\n\n", $content);
    
    // Only write if content changed
    if ($content !== $originalContent) {
        file_put_contents($file, $content);
        $filesTransformed++;
        echo "Final cleanup applied to: $file\n";
    }
}

echo "Final cleanup complete! Transformed $filesTransformed files.\n";

// Now let's check for any remaining issues
echo "\nChecking for remaining issues...\n";

$remainingIssues = 0;
foreach ($actionFiles as $file) {
    $content = file_get_contents($file);
    
    // Check for remaining Lorisleiva imports
    if (strpos($content, 'Lorisleiva') !== false) {
        echo "WARNING: $file still contains Lorisleiva imports\n";
        $remainingIssues++;
    }
    
    // Check for ActionRequest
    if (strpos($content, 'ActionRequest') !== false) {
        echo "WARNING: $file still contains ActionRequest\n";
        $remainingIssues++;
    }
    
    // Check for AsController trait usage
    if (strpos($content, 'use AsController') !== false || strpos($content, 'use AsAction') !== false) {
        echo "WARNING: $file still uses traits\n";
        $remainingIssues++;
    }
    
    // Check for asController methods
    if (preg_match('/public function asController/i', $content)) {
        echo "WARNING: $file still has asController method\n";
        $remainingIssues++;
    }
}

if ($remainingIssues === 0) {
    echo "✅ All files appear to be properly transformed!\n";
} else {
    echo "⚠️  Found $remainingIssues remaining issues that need manual review.\n";
}
