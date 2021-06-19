# laragrad/eloquent-model-userstamps

This package provides a trait for Model to fill userstamp fields.

## Installing

Run command in console

	composer require laragrad/eloquent-model-userstamps

## Using

### Preparing table

Add into your model's table migration userstamp fields. It's type must be same as type of user id. You can use default **created_by**, **updated_by**, **deleted_by** field names or any other.

You can use `Laragrad\Support\Userstamps` `methods addUserstampColumns()` to add or `dropUserstampColumns()` drop columns in your migration file. 

For example, to add userstamps columns:

```
<?php

use ...;
use Laragrad\Support\Userstamps as UserstampsSupport; // Add use

class CreateExampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examples', function (Blueprint $table) {
            
            $table->id('id');
            ...
            UserstampsSupport::addUserstampsColumns($table); // Creating columns

        });
    }

    ...
}
```

If you use soft deleting in your table then put true into 2nd argument. 
To change type of your userstamps columns you can put 'uuid' or 'integer' or 'bigInteger' into 3rd argument.
By default created columns has default names. If your userstamp columns have not default names then put column name array into 4th argument. 

For example:

	UserstampsSupport::addUserstampsColumns($table, true, 'uuid', ['create_user_id','update_user_id','deleted_user_id']);

To drop columns you can use `UserstampsSupport::dropUserstampsColumns()`. For example

	UserstampsSupport::dropUserstampsColumns($table, true, ['create_user_id','update_user_id','deleted_user_id']);


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
