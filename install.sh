bash#!/bin/bash

components=(
  "accordion"
  "alert" 
  "alert-dialog"
  "aspect-ratio"
  "avatar"
  "badge"
  "breadcrumb"
  "button"
  "calendar"
  "card"
  "carousel"
  "checkbox"
  "collapsible"
  "command"
  "context-menu"
  "date-picker"
  "dialog"
  "dropdown-menu"
  "form"
  "hover-card"
  "input"
  "label"
  "menubar"
  "navigation-menu"
  "pagination"
  "popover"
  "progress"
  "radio-group"
  "resizable"
  "scroll-area"
  "select"
  "separator"
  "sheet"
  "skeleton"
  "slider"
  "sonner"
  "switch"
  "table"
  "tabs"
  "textarea"
  "toast"
  "toggle"
  "toggle-group"
  "tooltip"
)

for component in "${components[@]}"; do
  echo "Installing $component..."
  npx shadcn-vue@latest add "$component"
  
  # Check if the command was successful
  if [ $? -ne 0 ]; then
    echo "Failed to install $component. Continuing with next component..."
  else
    echo "✅ Successfully installed $component"
  fi
  
  # Optional: Add a small delay to avoid overwhelming the server
  sleep 1
done

echo "🎉 Installation complete!"