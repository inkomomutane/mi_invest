#!/bin/bash

# Mapping of Portuguese to English names
declare -A name_map=(
    ["Imovel"]="Property"
    ["Imovels"]="Properties"
    ["imovel"]="property"
    ["imovels"]="properties"
)

# Function to rename class names in file content
rename_in_content() {
    local file="$1"
    local newfile="$2"
    
    # Copy file first
    cp "$file" "$newfile"
    
    # Replace class names and other references
    sed -i 's/class GetImovels/class GetProperties/g' "$newfile"
    sed -i 's/class CreateImovel/class CreateProperty/g' "$newfile"
    sed -i 's/class EditImovel/class EditProperty/g' "$newfile"
    sed -i 's/class UpdateImovel/class UpdateProperty/g' "$newfile"
    sed -i 's/class DeleteImovel/class DeleteProperty/g' "$newfile"
    sed -i 's/class StoreImovel/class StoreProperty/g' "$newfile"
    sed -i 's/class ApproveImovel/class ApproveProperty/g' "$newfile"
    sed -i 's/class RefuseImovel/class RefuseProperty/g' "$newfile"
    sed -i 's/class FilteredImovel/class FilteredProperty/g' "$newfile"
    sed -i 's/class CommentImovel/class CommentProperty/g' "$newfile"
    sed -i 's/class CountNotApprovedImovels/class CountNotApprovedProperties/g' "$newfile"
    sed -i 's/class GetNotApprovedImovels/class GetNotApprovedProperties/g' "$newfile"
    sed -i 's/class GetDeletedImovels/class GetDeletedProperties/g' "$newfile"
    sed -i 's/class RestoreDeletedImovel/class RestoreDeletedProperty/g' "$newfile"
    sed -i 's/class SendMessageFromImovel/class SendMessageFromProperty/g' "$newfile"
    sed -i 's/class ImovelApprovement/class PropertyApprovement/g' "$newfile"
    sed -i 's/class ImovelTrashCount/class PropertyTrashCount/g' "$newfile"
    sed -i 's/class ApproveImovelDeletion/class ApprovePropertyDeletion/g' "$newfile"
    
    # Replace trait usage
    sed -i 's/GetImovelsWithSearchScope/GetPropertiesWithSearchScope/g' "$newfile"
    sed -i 's/getImovels(/getProperties(/g' "$newfile"
    
    # Replace route names
    sed -i "s/'imovel\./'property\./g" "$newfile"
    sed -i 's/imovel\./property\./g' "$newfile"
    
    # Replace view names
    sed -i 's/CreateImovel/CreateProperty/g' "$newfile"
    sed -i 's/EditProperty/EditProperty/g' "$newfile"
    sed -i 's/NotApprovedImovels/NotApprovedProperties/g' "$newfile"
    
    # Replace variable names in views
    sed -i 's/imovels/properties/g' "$newfile"
    
    echo "Processed: $file -> $newfile"
}

echo "Renaming Imovel files to Property files..."
