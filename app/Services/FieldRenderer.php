namespace App\Services;

use App\Models\Field;

class FieldRenderer
{
    public function render(Field $field, $value)
    {
        $viewPath = "fields.{$field->type}";

        if (view()->exists($viewPath))
        {
            return view($viewPath, ['field' => $field, 'value' => $value])->render();
        }

        // Default fallback view for unknown types
        return view('fields.default', ['field' => $field, 'value' => $value])->render();
    }
}