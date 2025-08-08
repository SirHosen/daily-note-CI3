<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <?php if($note['is_important']): ?>
                            <i class="fas fa-star text-warning"></i>
                        <?php endif; ?>
                        <?php echo $note['title']; ?>
                    </h4>
                    <div>
                        <?php if($note['category_name']): ?>
                            <span class="badge bg-secondary"><?php echo $note['category_name']; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-3 text-muted">
                    <small>
                        <i class="far fa-clock"></i> Created: <?php echo date('F d, Y h:i A', strtotime($note['created_at'])); ?>
                        <?php if($note['updated_at'] != $note['created_at']): ?>
                            | Updated: <?php echo date('F d, Y h:i A', strtotime($note['updated_at'])); ?>
                        <?php endif; ?>
                    </small>
                </div>
                
                <div class="note-full-content">
                    <?php echo nl2br($note['content']); ?>
                </div>
                
                <hr>
                
                <div class="d-flex justify-content-between">
                    <a href="<?php echo base_url('notes'); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Notes
                    </a>
                    <div>
                        <a href="<?php echo base_url('notes/edit/'.$note['id']); ?>" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button onclick="confirmDelete('<?php echo base_url('notes/delete/'.$note['id']); ?>')" 
                                class="btn btn-danger">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
