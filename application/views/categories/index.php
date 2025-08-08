<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-plus"></i> Add New Category</h5>
            </div>
            <div class="card-body">
                <?php echo form_open('categories/create'); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="color" class="form-control form-control-color" id="color" name="color" value="#007bff">
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save"></i> Save Category
                    </button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-tags"></i> All Categories</h5>
            </div>
            <div class="card-body">
                <?php if(empty($categories)): ?>
                    <p class="text-muted text-center">No categories found.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Name</th>
                                    <th>Notes Count</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($categories as $category): ?>
                                    <tr>
                                        <td>
                                            <span class="badge" style="background-color: <?php echo $category['color']; ?>">
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                            </span>
                                        </td>
                                        <td><?php echo $category['name']; ?></td>
                                        <td>
                                            <span class="badge bg-secondary"><?php echo $category['note_count']; ?></span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($category['created_at'])); ?></td>
                                        <td>
                                            <button onclick="confirmDelete('<?php echo base_url('categories/delete/'.$category['id']); ?>')" 
                                                    class="btn btn-sm btn-danger" 
                                                    <?php echo $category['note_count'] > 0 ? 'disabled' : ''; ?>>
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <?php if($category['note_count'] > 0): ?>
                                                <small class="text-muted d-block">Has notes</small>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
