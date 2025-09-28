# Button Style Guide

This document defines the standard button styles used throughout the Syndic Management System to ensure UI consistency.

## Action Button Standards

### Primary Action Buttons (CRUD Operations)

**Edit Button:**
```html
<button class="btn btn-sm btn-warning" onclick="loadModal('{{ route('model.edit', $model) }}')">
    <i class="fas fa-pen"></i>
</button>
```
- **Classes:** `btn btn-sm btn-warning` (solid yellow/orange)
- **Icon:** `fas fa-pen` 
- **Color:** Warning (yellow/orange)
- **Size:** Small (`btn-sm`)

**Delete Button:**
```html
<button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('model.destroy', $model) }}', 'Confirmation message')">
    <i class="fas fa-trash"></i>
</button>
```
- **Classes:** `btn btn-sm btn-danger` (solid red)
- **Icon:** `fas fa-trash`
- **Color:** Danger (red)
- **Size:** Small (`btn-sm`)

### Secondary Action Buttons

**View/Show Button:**
```html
<button class="btn btn-sm btn-info" onclick="loadModal('{{ route('model.show', $model) }}')">
    <i class="fas fa-eye"></i>
</button>
```

**Add/Create Button:**
```html
<button class="btn btn-primary" onclick="loadModal('{{ route('model.create') }}')">
    <i class="fas fa-plus"></i> Add New
</button>
```

### Button Groups
When multiple action buttons are grouped together:
```html
<div class="btn-group" role="group">
    <button class="btn btn-sm btn-warning" onclick="..."><i class="fas fa-pen"></i></button>
    <button class="btn btn-sm btn-danger" onclick="..."><i class="fas fa-trash"></i></button>
</div>
```

## ❌ Avoid These Inconsistencies

**DON'T use outline buttons for primary actions:**
```html
<!-- WRONG -->
<button class="btn btn-sm btn-outline-primary">
<button class="btn btn-sm btn-outline-danger">
```

**DON'T use different icons for the same action:**
```html
<!-- WRONG -->
<i class="fas fa-edit"></i>  <!-- Use fa-pen instead -->
```

## Color Scheme
- **Primary:** `btn-primary` (blue) - Main CTAs, create buttons
- **Warning:** `btn-warning` (yellow/orange) - Edit actions  
- **Danger:** `btn-danger` (red) - Delete actions
- **Info:** `btn-info` (light blue) - View/info actions
- **Success:** `btn-success` (green) - Success confirmations
- **Secondary:** `btn-secondary` (gray) - Cancel, neutral actions

## Sizes
- **Normal:** No size class (default size)
- **Small:** `btn-sm` (for table actions)
- **Large:** `btn-lg` (for prominent CTAs)

This standardization ensures a consistent user experience across all views and components.