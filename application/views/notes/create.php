<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus"></i> Create New Note</h4>
            </div>
            <div class="card-body">
                <?php echo form_open('notes/create'); ?>
                    
                    <div class="mb-3">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" class="form-control <?php echo form_error('title') ? 'is-invalid' : ''; ?>" 
                               id="title" name="title" value="<?php echo set_value('title'); ?>" 
                               placeholder="Enter note title">
                        <?php echo form_error('title', '<div class="invalid-feedback">', '</div>'); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id">
                            <option value="">No Category</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>" 
                                        <?php echo set_select('category_id', $category['id']); ?>>
                                    <?php echo $category['name']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="content" class="form-label">Content *</label>
                        <textarea class="form-control <?php echo form_error('content') ? 'is-invalid' : ''; ?>" 
                                  id="content" name="content" rows="8" 
                                  placeholder="Write your note here..."><?php echo set_value('content'); ?></textarea>
                        <?php echo form_error('content', '<div class="invalid-feedback">', '</div>'); ?>
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_important" 
                                   name="is_important" value="1" <?php echo set_checkbox('is_important', '1'); ?>>
                            <label class="form-check-label" for="is_important">
                                <i class="fas fa-star text-warning"></i> Mark as important
                            </label>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?php echo base_url('notes'); ?>" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Note
                        </button>
                    </div>
                    
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
