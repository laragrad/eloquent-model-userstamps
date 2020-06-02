# laragrad/eloquent-model-userstamps

This package provides a trait for Model to fill userstamp fields.

## Installing

Run command in console

	composer require laragrad/eloquent-model-userstamps

## Using

### Preparing table

Add into your model's table migration userstamp fields. It's type must be same as type of user id. You can use default **created_by**, **updated_by**, **deleted_by** field names or any other.

### Preparing model

Add next changes into your table model class:

  * add use trait `\Laragrad\Models\Concerns\HasUserstamps` into your model class;
  * add property `public $userstamps = true;`

	use Laragrad\Models\Concerns\HasUserstamps; // (1)
	
	class YourModel extends Model
	{
		use HasUserstamps;							 // (2)
		
		public $userstamps = true;					 // (3)
		
		...
	}
	
The `created_by` and `updated_by` fields in your model will now be populated in the same way as the timestamp fields when you create or update the model. If your model uses `SoftDeletes` trait, will also be processed field, `deleted_by`.

### Using custom userstamp field names

If your table userstamp field names are not defaults then declare next constants in your model:

	class YourModel extends Model
	{
		...
		
		const CREATED_BY = 'your_created_by_field_name'; 
		const UPDATED_BY = 'your_updated_by_field_name'; 
		const DELETED_BY = 'your_deleted_by_field_name'; 
		
		...
	}
